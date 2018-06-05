<template>
    <div class="routine-form">
        <!-- title, name -->
        <div class="routine-form__form">
            <h4 class="routine-form__title">
                {{ title }}
            </h4>
            <div class="routine-form__form-group">
                <label>Name</label>
                <input 
                    class="routine-form__form-control"
                    v-model="name"
                >
                </input>
            </div>
        </div>
        <!-- days -->
        <div class="routine-form__days">
            <label class="routine-form__label">Days</label>
            <div v-for="day in days">
                <div 
                    class="routine-form__day" 
                    v-bind:class="{ 'routine-form__day--active': day.id === selected }"
                    @click="select(day)"
                >
                    {{ day.name }}
                </div>
                <template 
                    v-if="day && day.exercises && day.id === selected"
                    v-for="exercise in day.exercises"
                >
                    <routine-day-exercise :exercise="exercise" :onChange="handleRoutineDayExerciseChange" />
                </template>
            </div>
        </div>
        <!-- buttons -->
        <div class="routine-form__buttons">
            <progress-button
                class="routine-form__button routine-form__button--primary"
                v-bind:class="{ disabled: !valid }"
                :working="working"
                :handleClick="onSubmitClick"
                :buttonText="buttonText"
            />
            <progress-button
                v-if="deleteable"
                class="routine-form__button routine-form__button--danger"
                :working="working"
                :handleClick="onDeleteClick"
                buttonText="Delete"
            />
            <div
                class="routine-form__alert"
                v-for="error in errors"
            >
                {{ error }}
            </div>
        </div>
    </div>
</template>

<script>

import ProgressButton from '../components/ProgressButton'
import RoutineDayExercise from '../components/RoutineDayExercise'
import { formatErrors } from '../utils/error'
import { mapActions } from 'vuex'

export default {

    components: {
        ProgressButton,
        RoutineDayExercise
    },

    props: {
        routine: {
            type: Object,
            default: null
        },
        onSubmit: Function,
        buttonText: String
    },

    data: function() {
        return {
            days: this.routine ? this.routine.days : [],
            name: this.routine ? this.routine.name : null,
            errors: [],
            selected: null,
            working: false
        }
    },

    methods: {

        onSubmitClick: async function() {

            try {

                if (!this.valid) { return }

                this.working = true

                const data = {
                    id: this.id,
                    name: this.name,
                }

                //await this.onSubmit(data)

                this.working = false
                this.$router.go(-1)

            } catch (e) {
                this.errors = formatErrors(e)
                this.working = false
            }

        },

        onDeleteClick: function() {
            const data = {
                open: true,
                props: {
                    headerText: `Delete ${this.name}?`,
                    bodyText: `Are you sure you want to delete ${this.name}?`,
                    onDelete: async () => { 
                        //await this.destroyExercise(this.id)
                        this.$router.go(-1)
                    }

                }
            }
            this.toggleConfirmModal(data)
        },

        select: function(day) {
            day.id === this.selected ? this.selected = null : this.selected = day.id
        },

        handleRoutineDayExerciseChange: function(routineDayExercise) {
            const oldDay = this.days.find(day => day.id === routineDayExercise.routine_day_id)
            let filtered = oldDay.exercises.filter(e => e.id !== routineDayExercise.id)
            const exercises = [...filtered, routineDayExercise]

            const newDay = {...oldDay, exercises}

            filtered = this.days.filter(day => day.id !== newDay.id)

            this.days = [...filtered, newDay]

        },

        ...mapActions([
            'toggleConfirmModal',
        ])

    },

    computed: {

        valid: function() {
            return (
                this.routine
            )
        },

        deleteable: function() {
            return !!this.routine
        },

        title: function() {
            return this.routine ? 'Edit Routine' : 'New Routine'
        },

    }

}

</script>

<style lang="scss" scoped>

@import '../../sass/bscore';
@import '../../sass/form';
@import '~bootstrap/scss/list-group';

.routine-form {

    @extend .form;
    margin: 0px;
    display: flex;
    flex-direction: column;

    &__title {
        text-align: center;
    }

    &__form {
        @extend .form__form;
        padding-top: 30px;
    }

    &__form-group {
        @extend .form__form-group;
    }

    &__form-control {
        @extend .form__form-control;
    }

    &__label {
        margin-bottom: .5rem;
        padding-left: 15px;
    }

    &__days {
        @extend .list-group;
    }

    &__day {
        @extend .list-group-item;
        @extend .list-group-item-action;
        border-radius: 0px!important;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;

        &--active {
            background: $primary!important;
            color: white!important;
        }
    }

    &__buttons {
        padding-top: 20px;
        padding-left: 15px;
        padding-right: 15px;
    }

    &__exercises {

        & > *:first-child {
            margin-top: 0px!important;
            margin-bottom: 5px!important;
        }
        & > *:last-child {
            margin-top: 5px;
            margin-bottom: 0px;
        }
        & > * {
            margin-top: 5px;
            margin-bottom: 5px;
        }

    }

    &__button {
        @extend .form__button;

        &--primary {
            @extend .btn-primary;
        }

        &--danger {
            @extend .btn-danger;
        }
    }

    &__form-row {
        @extend .form__form-row;
    }

    &__alert {
        @extend .form__alert;
    }
}

</style>
