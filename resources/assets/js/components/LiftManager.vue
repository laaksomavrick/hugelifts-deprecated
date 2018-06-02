<template>
    <div class="exercises">
        <div 
            v-for="exercise in getExercises"
            class="exercises__item"
            @click="handleExerciseClick(exercise)"
        >
            {{ exercise.name }}
            <span 
                class="exercises__repmax"
            >
                {{ maxRep(exercise) }}
            </span>
        </div>
    </div>
</template>

<script>

import { mapActions, mapGetters } from 'vuex'
import { getOneRepMax } from '../utils/lifts'
import { EDIT_LIFT_ROUTE } from '../constants'

export default {

    data: function() {
        return {

        }
    },

    mounted: function() {

    },

    methods: {

        handleExerciseClick: function(exercise) {
            const id = exercise.id
            this.$router.push({ name: EDIT_LIFT_ROUTE, params: { id }})
        },

        maxRep: function(exercise) {
            return getOneRepMax(exercise.rep_max, exercise.rep_max_interval)
        }

    },

    computed: {

        ...mapGetters([
            'getExercises'
        ])

    }

}
</script>

<style lang="scss" scoped>

@import '../../sass/bscore';
@import '~bootstrap/scss/list-group';
@import '~bootstrap/scss/badge';

.exercises {

    @extend .list-group;

    &__item {
        @extend .list-group-item;
        @extend .list-group-item-action;
        border-radius: 0px!important;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    &__repmax {
        @extend .badge;
        @extend .badge-primary;
        @extend .badge-pill;
    }

}

</style>
