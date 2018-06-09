<template>
    <div class="exercise-row">
        <div class="exercise-row__name">
            {{ name }}
        </div>
        <div class="exercise-row__sets">
            <div v-for="set in sets" class="exercise-row__set">
                <div class="exercise-row__reps">
                   {{ set.reps }} 
                </div>
                <div class="exercise-row__weight">
                    {{ weight(set) }}
                </div>
            </div>
        </div>
    </div>

</template>

<script>

import { getOneRepMax } from '../utils/lifts'
import { mapGetters } from 'vuex'

export default {

    props: {
        exercise: Object
    },

    methods: {

        weight: function(set) {
            const exercise = this.exerciseMeta
            const oneRepMax = getOneRepMax(exercise.rep_max, exercise.rep_max_interval)
            return `${Math.ceil(oneRepMax * (set.percentage / 100) / 5) * 5}lbs`
        },

    },

    computed: {

        name: function() {
            return this.exerciseMeta.name
        },

        exerciseMeta: function() {
            return this.getExercise(this.exercise.exercise_id)
        },

        sets: function() {
            return this.exercise.sets
        },

        ...mapGetters([
            'getExercise'
        ])

    }

}

</script>

<style lang="scss" scoped>

@import '../../sass/bscore';
@import '~bootstrap/scss/list-group';

.exercise-row {

    @extend .list-group-item;
    padding: 0.75rem;
    margin-bottom: 5px;

    &--complete {

    }

    &__name {
        font-size: 1.1rem;
        margin-bottom: 5px;
    }

    &__sets {
        display: flex;
        justify-content: space-evenly;
    }

    &__set {
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin-left: 3px;
        margin-right: 3px;
    }

    &__reps {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 45px;
        height: 45px;
        border-radius: 22.5px;
        border: 3px solid $primary;
        margin-bottom: 2px;
        cursor: pointer;
        font-size: 1.0rem;
    }

    &__weight {
        font-size: 0.7rem;
        text-align: center;
    }

}

</style>
