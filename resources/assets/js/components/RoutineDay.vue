<template>
    <div class="routine-day">
        <template
            v-for="exercise in sortedExercises"
        >
            <routine-day-exercise
                :key="exercise.id"
                :exercise="exercise" 
                :onChange="handleRoutineDayExerciseChange" />

        </template>
        <div class="routine-day__actions">
            <b-btn
                class="routine-day__edit-btn"
                variant="secondary"
                @click="handleEditDay">
                    Edit Lifts
            </b-btn>
        </div>
    </div>
</template>

<script>

import RoutineDayExercise from '../components/RoutineDayExercise'
import { mapActions } from 'vuex'

export default {

    props: {
        day: Object,
        onChange: Function
    },

    components: {
        RoutineDayExercise
    },

    methods: {

        handleRoutineDayExerciseChange: function(routineDayExercise) {
            const filtered = this.day.exercises.filter(e => 
                e.exercise_id !== routineDayExercise.exercise_id
            )
            const exercises = [...filtered, routineDayExercise]
            const routineDay = {...this.day, exercises }
            this.onChange(routineDay)
        },

        handleEditDay: function() {
            const data = {
                open: true,
                props: {
                    headerText: `Edit ${this.day.name}`,
                    day: this.day,
                    onSubmit: async (routineDay) => { 
                        this.onChange(routineDay)
                    }
                }
            }
            this.toggleRoutineDayExercisesModal(data)
        },

        ...mapActions([
            'toggleRoutineDayExercisesModal'
        ])

    },

    computed: {
        
        sortedExercises: function() {
            return this.day.exercises.sort((a, b) => a.ordinal > b.ordinal)
        }
    }

}

</script>

<style lang="scss">

.routine-day {

    &__actions {
        display: flex;
        justify-content: center;
        margin-bottom: 1rem;
    }

    &__edit-btn {
        width: 33%;
    }

}

</style>
