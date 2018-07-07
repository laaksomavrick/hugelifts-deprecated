<template>
    <div class="exercise">
        <div class="exercise__header">
            <div class="exercise__header-text">
                {{ name }}
            </div>
            <div class="exercise__header-context">
                <div>
                Reps
                </div>
                <div>
                1RM%
                </div>
            </div>
        </div>
        <div class="exercise__content">
            <template v-for="(set, index) in sortedSets">
                <set-row :ordinal="index" :set="set" :onChange="handleSetChange" :onRemove="handleSetRemove" />
            </template>
            <button 
                class="exercise__add-set"
                @click="handleSetAdd"
            >
                Add
            </button>
        </div>
    </div>
</template>

<script>

import { mapGetters } from 'vuex'
import SetRow from './SetRow'

export default {

    props: {
        exercise: Object,
        onChange: Function
    },

    components: {
        SetRow
    },

    methods: {

        handleSetChange: function(changedSet) {

            const filtered = this.exercise.sets.filter(set => set.id !== changedSet.id)
            const sets = [...filtered, changedSet]

            const routineDayExercise = {...this.exercise, sets }
            this.onChange(routineDayExercise)
        },

        handleSetRemove: function(removedSet) {

            const filtered = this.exercise.sets.filter(set => set.id !== removedSet.id)
            const sets = [...filtered]

            const routineDayExercise = {...this.exercise, sets }
            this.onChange(routineDayExercise)
        },

        handleSetAdd: function() {
            
            const id = this.exercise.sets.length === 0 ? 1 : this.exercise.sets[this.exercise.sets.length - 1].id + 1
            const set = {...this.exercise.sets[this.exercise.sets.length - 1], id: id}
            const sets = [...this.exercise.sets, set]

            const routineDayExercise = {...this.exercise, sets }
            this.onChange(routineDayExercise)
        }

    },

    computed: {

        name: function() {
            const id = this.exercise.exercise_id
            return this.getExercise(id).name
        },

        sortedSets: function() {
            return this.exercise.sets.sort((a, b) => a.id > b.id)
        },

        ...mapGetters([
            'getExercise'
        ])

    }

}

</script>

<style lang="scss" scoped>


</style>
