<template>
    <b-form class="routine-form" @submit="onSubmitClick">

        <form-header :title="title" />

        <b-form-group
            class="routine-form__form-group"
            label="Name">
            <b-form-input 
                class="routine-form__form-control"
                v-model="name">
            </b-form-input>
        </b-form-group>

        <!-- days -->
        <b-form-group 
            class="routine-form__days"
            label="Days">
            <div v-for="day in sortedDays" :key="day.ordinal">
                <b-btn 
                    class="routine-form__day-btn"
                    variant="primary"
                    v-b-toggle="`collapse-${day.ordinal}`"
                    @click="select(day)">
                    {{ day.name }}
                </b-btn>

                <b-collapse :id="`collapse-${day.ordinal}`" :visible="day.id === selected">
                    <routine-day 
                        :day="day" 
                        :onChange="handleRoutineDayChange"/>
                </b-collapse>

            </div>
        </b-form-group>

    <!-- buttons -->
        <div class="routine-form__buttons">
            <progress-button
                v-if="deleteable"
                variant="danger"
                :submitWorking="deleteWorking"
                :handleClick="onDeleteClick"
                buttonText="Delete"
            />
            <b-button 
                class="routine-form__edit-btn"
                variant="secondary"
                @click="handleEditDays">
                Edit Days
            </b-button>
            <progress-button
                class="routine-form__update-btn"
                v-bind:class="{ disabled: !valid }"
                :submitWorking="submitWorking"
                :handleClick="onSubmitClick"
                :buttonText="buttonText"
            />
        </div>
        <b-alert
            v-for="(error, index) in errors"
            variant="danger"
            :key="index">
            {{ error }}
        </b-alert>
    </b-form>
</template>

<script>

import ProgressButton from '../components/ProgressButton'
import RoutineDay from '../components/RoutineDay'
import FormHeader from '../components/FormHeader'
import { formatErrors } from '../utils/error'
import { mapActions } from 'vuex'

export default {

    components: {
        ProgressButton,
        RoutineDay,
        FormHeader,
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
            submitWorking: false,
            deleteWorking: false
        }
    },

    methods: {

        onSubmitClick: async function(e) {

            try {
                
                e.preventDefault()

                if (!this.valid) { return }

                this.submitWorking = true

                const data = {
                    id: this.routine ? this.routine.id : null,
                    name: this.name,
                    days: this.days
                }

                await this.onSubmit(data)

                this.submitWorking = false
                this.$router.go(-1)

            } catch (e) {
                console.error(e)
                this.errors = formatErrors(e)
                this.submitWorking = false
            }

        },

        onDeleteClick: function() {
            const data = {
                open: true,
                props: {
                    headerText: `Delete ${this.name}?`,
                    bodyText: `Are you sure you want to delete ${this.name}?`,
                    onDelete: async () => {
                        await this.destroyRoutine(this.routine.id)
                        this.deleteWorking = false
                        this.$router.go(-1)
                    }
                }
            }
            this.deleteWorking = true
            this.toggleConfirmModal(data)
        },

        select: function(day) {
            day.id === this.selected ? this.selected = null : this.selected = day.id
        },

        handleEditExercise: function() {
            if (!this.selected) { return }
            const day = this.days.find(d => d.id === this.selected)
            const data = {
                open: true,
                props: {
                    headerText: `Edit ${day.name}`,
                    day: day,
                    onSubmit: async (routineDay) => { 
                        this.handleRoutineDayChange(routineDay)
                        if (routineDay.exercises.length === 0) {
                            this.selected = null
                        }
                    }

                }
            }
            this.toggleRoutineDayExercisesModal(data)
        },

        handleEditDays: function() {
            const routine = {...this.routine, days: this.days}
            const data = {
                open: true,
                props: {
                    headerText: this.name ? `Add days to ${this.name}` : 'Add days',
                    routine: routine,
                    onSubmit: async (routine) => { 
                        this.days = [...routine.days ]
                    }
                }
            }
            this.toggleRoutineDaysModal(data)
        },

        handleRoutineDayChange: function(routineDay) {
            const filtered = this.days.filter(day => day.id !== routineDay.id)
            this.days = [...filtered, routineDay]
        },

        ...mapActions([
            'toggleRoutineDayExercisesModal',
            'toggleRoutineDaysModal',
            'toggleConfirmModal',
            'destroyRoutine'
        ])

    },

    computed: {

        valid: function() {
            return (
                   this.name
                && this.days.length > 0
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

.routine-form {


    &__buttons {
        display: flex;
    }

    &__day-btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }

    &__edit-btn {
        margin-left: .5rem;
    }

    &__update-btn {
        margin-left: auto;
    }

}

</style>
