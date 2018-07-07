<template>
    <b-list-group class="exercises">
        <b-list-group-item 
            v-for="exercise in getExercises"
            v-bind:key="exercise.id"
            class="exercises__item"
            @click="handleExerciseClick(exercise)"
        >
            {{ exercise.name }}
            <b-badge 
                variant="primary"
                pill
                class="exercises__repmax">
                {{ maxRep(exercise) }}
            </b-badge>
        </b-list-group-item>
    </b-list-group>
</template>

<script>

import { mapActions, mapGetters } from 'vuex'
import { getOneRepMax } from '../utils/lifts'
import { EDIT_LIFT_ROUTE } from '../constants'

export default {

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

.exercises {

    &__item {
        display: flex;
        align-items: center;
    }

    &__repmax {
        margin-left: auto;
    }

}

</style>
