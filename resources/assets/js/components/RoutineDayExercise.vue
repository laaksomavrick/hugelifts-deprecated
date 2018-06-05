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
                <set-row :ordinal="index" :set="set" :onChange="handleSetChange" />
            </template>
            <button 
                class="exercise__add-set"
                @click="handleAddSet"
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

        handleAddSet: function() {

            const set = {...this.exercise.sets[this.exercise.sets.length - 1]}
            delete set.id
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

@import '../../sass/bscore';
@import '~bootstrap/scss/list-group';
@import '~bootstrap/scss/buttons';

.exercise {

    @extend .list-group-item;
    border-bottom-right-radius: 0px!important;
    border-bottom-left-radius: 0px!important;
    border-top-right-radius: 0px!important;
    border-top-left-radius: 0px!important;

    &__header {
        display: flex;
        margin-bottom: 5px;
    }

    &__header-context {
        margin-left: auto;
        display: flex;
        & > * {
            min-width: 50px;
            max-width: 80px;
            margin-left: 5px;
            margin-right: 5px;
            text-align: center;
            opacity: 0.7;
        }
    }

    &__content {
        padding-left: 20px;

        & > *:first-child {
            margin-top: 0px!important;
            margin-bottom: 5px;
        }
        & > *:last-child {
            margin-top: 5px;
            margin-bottom: 0px;
        }
        & > *  {
            margin-top: 5px;
            margin-bottom: 5px;
        }
    }

    &__add-set {
        @extend .btn;
        @extend .btn-primary;
        width: 55px;
    }

}

</style>
