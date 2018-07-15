<template>
    <div class="exercise-row">
        <b-list-group-item class="exercise-row__content">
            <h5 class="exercise-row__name">
                {{ name }}
            </h5>
            <div class="exercise-row__sets">
                <div 
                    v-for="set in sets" 
                    :key="set.id"
                    class="exercise-row__set">
                    <div 
                        class="exercise-row__reps" 
                        @click="handleClick(set)" 
                        v-bind:class="{ 'exercise-row__reps--active': set.active }"
                    >
                        <template v-if="set.active === false">
                           {{ set.reps }} 
                        </template>
                        <template v-else>
                            {{ set.completed_reps }}
                        </template>
                    </div>
                    <div class="exercise-row__weight">
                        {{ weight(set) }}
                    </div>
                </div>
            </div>
        </b-list-group-item>
    </div>
</template>

<script>

import { getOneRepMax } from '../utils/lifts'
import { mapGetters } from 'vuex'

export default {

    props: {
        exercise: Object
    },

    data: function() {
        return {
            sets: this.formattedSets()
        }
    },

    methods: {

        weight: function(set) {
            const exercise = this.exerciseMeta
            const oneRepMax = getOneRepMax(exercise.rep_max, exercise.rep_max_interval)
            return `${Math.ceil(oneRepMax * (set.percentage / 100) / 5) * 5}lbs`
        },

        formattedSets: function() {
            const sets = this.exercise.sets.map(set => {
                return {...set, completed_reps: 0, completed: false, active: false}
            })
            return sets
        },

        handleClick: function(set) {
            set = this.sets.find(s => s.id === set.id)
            if (!set.active) {
                set.active = true
            }
            if (set.completed_reps === 0) {
                set.completed_reps = set.reps
            } else if (set.completed_reps > 0){
                set.completed_reps = set.completed_reps - 1
            }
            this.checkAndHandleCompleted()
        },

        checkAndHandleCompleted: function() {
            const done = this.sets.filter(s => s.active === false).length === 0
            if (done) {
                const record = this.sets.filter(s => s.completed_reps !== s.reps).length === 0
                const data = { id: this.exercise.id, exercise_id: this.exercise.exercise_id, record }
                this.$emit('completed', data)
            }
        }

    },

    computed: {

        name: function() {
            return this.exerciseMeta.name
        },

        exerciseMeta: function() {
            return this.getExercise(this.exercise.exercise_id)
        },

        ...mapGetters([
            'getExercise'
        ])

    }

}

</script>

<style lang="scss" scoped>

.exercise-row {

    $primary: #007bff;
    margin-bottom: .5rem;

    &__content {
        cursor: unset;

        &:hover {
            background: white;
        }
    }

    &__sets {
        display: flex;
        justify-content: space-evenly;
        flex-wrap: wrap;
    }

    &__set {
        display: flex;
        flex-direction: column;
        justify-content: center;
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
        user-select: none;
        font-size: 1.0rem;
        &--active {
            background: $primary;
            color: white;
        }
    }

    &__weight {
        font-size: 0.75rem;
        text-align: center;
    }

}

</style>
