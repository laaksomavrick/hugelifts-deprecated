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
            <template v-for="(set, index) in sets">
                <set-row :ordinal="index" :set="set" />
            </template>
        </div>
    </div>
</template>

<script>

import { mapGetters } from 'vuex'
import SetRow from './SetRow'

export default {

    props: {
        exercise: Object
    },

    components: {
        SetRow
    },

    computed: {

        name: function() {
            const id = this.exercise.id
            return this.getExercise(id).name
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

.exercise {

    @extend .list-group-item;

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

}

</style>
