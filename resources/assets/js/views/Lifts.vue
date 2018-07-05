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
</style>
