<template>
    <div class="schedule-form">
        <div class="schedule-form__header">
            {{ dayName }}
        </div>
        <div class="schedule-form__exercises">
            <template v-for="exercise in exercises">
                <exercise-row :exercise="exercise" @completed="handleExerciseCompleted"/>
            </template>
        </div>
        <div class="schedule-form__submit">
            <progress-button
                class="schedule-form__button schedule-form__button--primary"
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
            workouts: [],
            working: false
        }
    },

    beforeCreate: function() {
        //todo check vuex for temp state; reset if tempStore is there
        console.log("beforeCreate")
    },

    mounted: function() {
    },

    beforeDestroy: function() {
        //todo set vuex temp state in EACH EXERCSIE ROW
        console.log("beforeDestroy")
        console.log(this.exercises)
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

                const id = this.schedule.id
                const records = this.workouts.filter(w => w.record === true)
                const data = { id, records }

                console.log(data)

                await this.updateSchedule(data)

                this.working = false

            } catch (e) {
                //TODO
                console.error(e)
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

@import '../../sass/bscore';
@import '~bootstrap/scss/buttons';

.schedule-form {

    display: flex;
    flex-direction: column;

    &__header {
        font-size: $list-header-font-size;
        padding: $list-header-padding;
        padding-left: 0px;
    }

    &__exercises {
        @include make-row();
    }

    &__submit {
        @include make-col(12);
        display: flex;
        justify-content: center;
        margin-top: 15px;
    }

    &__button {

        @extend .btn;

        &--primary {

            @extend .btn-primary;

        }

    }
}

</style>
