<template>
    <div class="exercise-row">
        <div class="exercise-row__content">
            <div class="exercise-row__name">
                {{ name }}
            </div>
            <div class="exercise-row__sets">
                <div v-for="set in sets" class="exercise-row__set" >
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
</style>
