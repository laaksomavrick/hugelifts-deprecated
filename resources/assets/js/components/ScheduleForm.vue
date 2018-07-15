<template>
    <div class="schedule-form">
        <h3 class="schedule-form__header">
            {{ dayName }}
        </h3>
        <div class="schedule-form__exercises">
            <template v-for="exercise in exercises">
                <exercise-row 
                    :exercise="exercise" 
                    :completing="completing"
                    @completed="handleExerciseCompleted" 
                    :key="exercise.id"/>
            </template>
        </div>
        <div class="schedule-form__submit">
            <progress-button
                class="schedule-form__button"
                v-bind:class="{ 'disabled': disabled }"
                :submitWorking="working"
                :handleClick="handleSubmit"
                buttonText="Complete Workout"
            />
        </div>
    </div>
</template>

<script>

import ExerciseRow from './ExerciseRow'
import ProgressButton from './ProgressButton'
import { mapGetters, mapActions } from 'vuex'

export default {

    components: {
        ExerciseRow,
        ProgressButton
    },

    data: function() {
        return {
            workouts: [], //TODO set this on load from localStorage
            working: false,
            completing: false
        }
    },

    methods: {

        handleExerciseCompleted: function(data) {
            const filtered = this.workouts.filter(w => w.id !== data.id)
            this.workouts = [...filtered, data]
        },

        handleSubmit: async function() {

            if (this.disabled) { return }

            try {

                this.working = true
                this.completing = true

                const id = this.schedule.id
                const records = this.workouts.filter(w => w.record === true)
                const data = { id, records }

                this.clearStorage()
                this.workouts = []
                await this.updateSchedule(data)
                this.working = false
                this.completing = false

            } catch (e) {
                //TODO
                console.error(e)
            }

        },

        clearStorage: function() {
            for (let exercise of this.exercises) {
                localStorage.removeItem(`routineExercise_${exercise.id}`)
            }
        },

        ...mapActions([
            'updateSchedule'
        ])

    },

    computed: {

        disabled: function() {
            return this.workouts.length !== this.exercises.length
        },

        dayName: function() {
            return this.getSchedule.day ? this.getSchedule.day.name : ''
        },

        exercises: function() {
            return this.getSchedule.day ? this.getSchedule.day.exercises.sort((a, b) => a.ordinal > b.ordinal) : []
        },

        schedule: function() {
            return this.getSchedule
        },

        ...mapGetters([
            'getSchedule'
        ])
    }

}

</script>

<style lang="scss" scoped>

.schedule-form {

    display: flex;
    flex-direction: column;

    &__submit {
        display: flex;
    }

    &__button {
        margin: auto;
    }

}

</style>
