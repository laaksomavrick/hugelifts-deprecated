<template>
    <div class="exercise-table">
        <div class="exercise-table__header">
            <div class="exercise-table__header-text">
                {{ name }}
            </div>
            <div class="exercise-table__header-actions">
                <b-btn 
                    v-if="hasSets"
                    variant="danger"
                    @click="handleSetRemove">
                    Remove
                </b-btn>
                <b-btn 
                    variant="primary"
                    @click="handleSetAdd">
                    Add
                </b-btn>
            </div>
        </div>
        <div class="exercise__content">
            <template v-for="(set, index) in sortedSets">
                <set-row :ordinal="index" :set="set" :onChange="handleSetChange" :onRemove="handleSetRemove" />
            </template>
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

        handleSetRemove: function() {

            const spliced = this.exercise.sets.splice(0, this.exercise.sets.length - 1)
            const sets = [...spliced]

            const routineDayExercise = {...this.exercise, sets }
            this.onChange(routineDayExercise)
        },

        handleSetAdd: function() {
            
            const id = this.exercise.sets.length === 0 ? 1 : this.exercise.sets[this.exercise.sets.length - 1].id + 1
            const set = {...this.exercise.sets[this.exercise.sets.length - 1], id: id}
            const sets = [...this.exercise.sets, set]

            const routineDayExercise = {...this.exercise, sets }
            this.onChange(routineDayExercise)
            console.log(this.exercise.sets)
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

        hasSets: function() {
            return this.exercise.sets.length > 0
        },

        ...mapGetters([
            'getExercise'
        ])

    }

}

</script>

<style lang="scss" scoped>

.exercise-table {

    &__header {
        display: flex;
        align-items: center;
    }

    &__header-text {

    }

    &__header-actions {
        margin-left: auto;
        display: flex;
    }

}

</style>
