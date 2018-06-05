<template>
    <div class="routine-day">
        <template
            v-if="visible"
            v-for="exercise in sortedExercises"
        >
            <routine-day-exercise :exercise="exercise" :onChange="handleRoutineDayExerciseChange" />
        </template>
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
        }

    },

    computed: {
        
        sortedExercises: function() {
            return this.day.exercises.sort((a, b) => a.ordinal > b.ordinal)
        }
    }

}

</script>

<style>

</style>
