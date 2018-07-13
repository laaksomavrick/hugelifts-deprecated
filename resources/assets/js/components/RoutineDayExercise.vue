<template>
    <div class="exercise-table">
        <div class="exercise-table__header">
            <h5 class="exercise-table__header-text">
                {{ name }}
            </h5>
            <div class="exercise-table__header-actions">
                <b-btn 
                    v-if="hasSets"
                    :disabled="lastSet"
                    variant="danger"
                    @click="handleSetRemove">
                    Remove
                </b-btn>
                <b-btn 
                    id="exercise-table-add"
                    variant="primary"
                    @click="handleSetAdd">
                    Add
                </b-btn>
            </div>
        </div>
        <table class="exercise-table__content">
            <tbody>
                <tr>
                    <th class="exercise-table__left-column">Set</th>
                    <td v-for="(set, index) in sortedSets" :key="index">
                        {{ index + 1 }}
                    </td>
                </tr>
                <tr>
                    <th class="exercise-table__left-column"> Reps </th>
                    <td v-for="(set, index) in sortedSets" :key="index">
                        <b-input
                            type="number"
                            min="1"
                            max="20"
                            step="1"
                            @change="handleRepChange($event, set)"
                            :value="set.reps"/>
                    </td>
                </tr>
                <tr>
                    <th class="exercise-table__left-column"> % of 1RM </th>
                    <td v-for="(set, index) in sortedSets" :key="index">
                        <b-input
                            type="number"
                            min="0"
                            max="100"
                            step="5"
                            @change="handlePercentageChange($event, set)"
                            :value="set.percentage"/>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

import { mapGetters } from 'vuex'

export default {

    props: {
        exercise: Object,
        onChange: Function
    },

    methods: {

        handleSetChange: function(changedSet) {

            const filtered = this.exercise.sets.filter(set => set.id !== changedSet.id)
            const sets = [...filtered, changedSet]

            console.log(sets)

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
            
            const id = this.exercise.sets.length === 0 ? (
                1 
            ) : (
                this.exercise.sets[this.exercise.sets.length - 1].id + 1
            )
            const set = {
                ...this.exercise.sets[this.exercise.sets.length - 1],
                id: id,
                reps: 5,
                percentage: 80
            }
            const sets = [...this.exercise.sets, set]
            const routineDayExercise = {...this.exercise, sets }
            this.onChange(routineDayExercise)
        },

        handleRepChange: function(e, oldSet) {
            const reps = parseInt(e)
            const set = { ...oldSet, reps }
            this.handleSetChange(set)
        },

        handlePercentageChange: function(e, oldSet) {
            const percentage = parseInt(e)
            const set = { ...oldSet, percentage }
            this.handleSetChange(set)
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

        sortedReps: function() {
            return this.sortedSets.map(set => set.reps)
        },

        hasSets: function() {
            return this.exercise.sets.length > 0
        },

        lastSet: function() {
            return this.exercise.sets.length === 1
        },

        ...mapGetters([
            'getExercise'
        ])

    }

}

</script>

<style lang="scss" scoped>

.exercise-table {

    overflow-x: auto;
    margin-bottom: 1rem;

    td {
        min-width: 70px;
        text-align: center;
        font-weight: 600;
    }

    &__header {
        display: flex;
        align-items: center;
        margin-bottom: .5rem;
        margin-top: .5rem;
    }

    &__header-text {
        margin-bottom: 0;
    }

    &__header-actions {
        margin-left: auto;
        display: flex;
    }

    &__left-column {
        padding-right: 1rem;
        text-align: left;
    }

    #exercise-table-add {
        margin-left: .5rem;
    }

}

</style>
