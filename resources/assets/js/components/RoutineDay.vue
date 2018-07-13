<template>
    <div class="routine-day">
        <template
            v-if="visible"
            v-for="exercise in sortedExercises"
        >
            <routine-day-exercise
                :key="exercise.id"
                :exercise="exercise" 
                :onChange="handleRoutineDayExerciseChange" />

        </template>
        <div class="routine-day__actions">
            <b-btn
                class="routine-day__add-btn"
                variant="secondary"
                @click="handleAddExercise">
                    Add Lift
            </b-btn>
        </div>
    </div>
</template>

<script>

import RoutineDayExercise from '../components/RoutineDayExercise'

export default {

    props: {
        day: Object,
        visible: Boolean,
        onChange: Function
    },

    components: {
        RoutineDayExercise
    },

    methods: {

        handleRoutineDayExerciseChange: function(routineDayExercise) {
            const filtered = this.day.exercises.filter(e => e.id !== routineDayExercise.id)
            const exercises = [...filtered, routineDayExercise]
            const routineDay = {...this.day, exercises }
            this.onChange(routineDay)
        },

        handleAddExercise: function() {
            console.log("todo")
        }

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

}

</style>
