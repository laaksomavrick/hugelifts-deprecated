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
    </div>
</template>

<script>

import ExerciseRow from './ExerciseRow'
import { mapGetters, mapActions } from 'vuex'

export default {

    components: {
        ExerciseRow
    },

    data: function() {
        return {
            workoutStatus: []
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
            console.log(data)
            //create or update depending if exists or not
        },

    },

    computed: {

        dayName: function() {
            return this.getSchedule.day ? this.getSchedule.day.name : ''
        },

        exercises: function() {
            return this.getSchedule.day ? this.getSchedule.day.exercises.sort((a, b) => a.ordinal > b.ordinal) : []
        },

        ...mapGetters([
            'getSchedule'
        ])
    }

}

</script>

<style lang="scss" scoped>

@import '../../sass/bscore';

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

}

</style>
