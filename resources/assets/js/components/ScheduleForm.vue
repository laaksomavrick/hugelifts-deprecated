<template>
    <div class="schedule-form">
        <div class="schedule-form__header">
            {{ dayName }}
        </div>
        <template v-for="exercise in exercises">
            <exercise-row :exercise="exercise" />
        </template>
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
        }
    },

    beforeCreate: function() {
        //todo check vuex for temp state; reset if tempStore is there
        console.log("beforeCreate")
    },

    beforeDestroy: function() {
        //todo set vuex temp state
        console.log("beforeDestroy")
    },

    methods: {

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

}

</style>
