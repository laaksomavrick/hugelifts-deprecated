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
            <div v-for="day in sortedDays">
                <div 
                    class="routine-form__day" 
                    v-bind:class="{ 'routine-form__day--active': day.id === selected }"
                >
                    <div class="routine-form__day-header" @click="select(day)">
                        {{ day.name }}
                    </div>
                </div>
                <routine-day :day="day" :onChange="handleRoutineDayChange" :visible="day.id === selected" />
            </div>
        </div>
        <!-- buttons -->
        <div class="routine-form__buttons">
            <div class="routine-form__add-buttons">
                <button 
                    v-bind:class="{ disabled: selected === null }"
                    class="routine-form__add-exercise"
                >
                    Edit Exercise 
                </button>
                <button 
                    class="routine-form__add-day"
                >
                    Edit Days 
                </button>
            </div>
            <progress-button
                class="routine-form__button routine-form__button--primary"
                v-bind:class="{ disabled: !valid }"
                :working="working"
                :handleClick="onSubmitClick"
                :buttonText="buttonText"
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

import FontAwesomeIcon from '@fortawesome/vue-fontawesome'
import faTimes from '@fortawesome/fontawesome-free-solid/faTimes'
import faPlus from '@fortawesome/fontawesome-free-solid/faPlus'

import ProgressButton from '../components/ProgressButton'
import RoutineDay from '../components/RoutineDay'
import { formatErrors } from '../utils/error'
import { mapActions } from 'vuex'

export default {

    components: {
        ProgressButton,
        RoutineDay,
        FontAwesomeIcon
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

        handleDayOptions: function(day) {
            console.log(day)
        },

        handleRoutineDayChange: function(routineDay) {
            const filtered = this.days.filter(day => day.id !== routineDay.id)
            this.days = [...filtered, routineDay]
            console.log(this.days)
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

        sortedDays: function() {
            return this.days ? this.days.sort((a, b) => a.ordinal > b.ordinal) : []
        },

        plus: function() {
            return faPlus 
        },

        times: function() {
            return faTimes 
        }

    }

}

</script>

<style lang="scss" scoped>

@import '../../sass/bscore';
@import '../../sass/form';
@import '~bootstrap/scss/list-group';
@import '~bootstrap/scss/buttons';

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
            @extend .list-group-item-primary;
        }
    }


    &__day-header {
        flex: 1;
        text-align: left;
    }

    &__day-option {
        margin-left: auto;    
        color: white;
        @extend .btn;
        width: 37px;
        height: 37px;
        padding: 5px;
        margin-left: 5px;

        svg {
            height: 15px;
            width: 15px;
        }

        &--primary {
            background: $primary;
        }

        &--danger {
            background: $danger;
        }
    }

    &__buttons {
        padding-top: 20px;
        padding-left: 15px;
        padding-right: 15px;
    }

    &__add-buttons {
        display: flex;
        & > *:first-child {
            margin-right: 2.5px;
        }
        & > *:last-child {
            margin-left: 2.5px;
        }
    }

    &__add-exercise {
        @extend .btn;
        @extend .btn-secondary;
        flex: 1;
    }

    &__add-day {
        @extend .btn;
        @extend .btn-secondary;
        flex: 1;
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
        margin-top: 5px;
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
