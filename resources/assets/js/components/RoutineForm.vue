<template>
    <div class="routine-form">
        <div class="routine-form__form">
            <!-- title, name -->
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
        </div>
        <!-- buttons -->
        <div class="routine-form__buttons">
            <div class="routine-form__add-buttons">
                <button 
                    v-bind:class="{ disabled: selected === null }"
                    class="routine-form__add-exercise"
                    @click="handleEditExercise"
                >
                    Edit Exercises 
                </button>
                <button 
                    class="routine-form__add-day"
                    @click="handleEditDays"
                >
                    Edit Days
                </button>
            </div>
            <progress-button
                class="routine-form__button routine-form__button--primary"
                v-bind:class="{ disabled: !valid }"
                :submitWorking="submitWorking"
                :handleClick="onSubmitClick"
                :buttonText="buttonText"
            />
            <progress-button
                v-if="deleteable"
                class="routine-form__button routine-form__button--danger"
                :submitWorking="deleteWorking"
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
            submitWorking: false,
            deleteWorking: false
        }
    },

    methods: {

        onSubmitClick: async function() {

            try {

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
                        this.days =  [...routine.days ]
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
</style>
