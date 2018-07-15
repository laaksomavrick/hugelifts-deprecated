<template>
    <div class="exercises">
        <view-actions class="exercises__actions">
            <template slot="left">
                <b-form-input 
                    type="text" 
                    placeholder="Search"
                    @input="search"/>
            </template>
            <template slot="right">
                <b-button 
                    @click="create" 
                    variant="primary">
                    New
                </b-button>
            </template>
        </view-actions>
        <b-list-group class="exercises__list">
            <b-list-group-item 
                v-for="exercise in exercises"
                v-bind:key="exercise.id"
                class="exercises__item"
                @click="handleExerciseClick(exercise)">
                <div class="exercises__text">
                    {{ exercise.name }}
                </div>
                <b-badge 
                    variant="primary"
                    pill
                    class="exercises__repmax">
                    {{ maxRep(exercise) }}
                </b-badge>
            </b-list-group-item>
        </b-list-group>
    </div>
</template>

<script>

import { mapActions, mapGetters } from 'vuex'
import ViewActions from '../components/ViewActions'
import { getOneRepMax } from '../utils/lifts'
import { textSearch } from '../utils/filters'
import { EDIT_LIFT_ROUTE, NEW_LIFT_ROUTE } from '../constants'

export default {

    components: {
        ViewActions
    },

    data: function() {
        return {
            query: null 
        }
    },

    methods: {

        handleExerciseClick: function(exercise) {
            const id = exercise.id
            this.$router.push({ name: EDIT_LIFT_ROUTE, params: { id }})
        },

        maxRep: function(exercise) {
            return getOneRepMax(exercise.rep_max, exercise.rep_max_interval)
        },

        create: function() {
            this.$router.push({ name: NEW_LIFT_ROUTE })
        },

        search: function(query) {
            query === '' ? (this.query = null) : (this.query = query)
        }

    },

    computed: {

        exercises: function() {
            const exercises = this.sortedExercises
            if (this.query) {
                return exercises.filter(exercise => textSearch(this.query, exercise.name))
            } else {
                return exercises
            }
        },

        sortedExercises: function() {
            const exercises = this.getExercises
            return exercises.sort((a, b) => a.name > b.name)
        },

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

    &__text {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-right: 1rem;
    }

    &__repmax {
        margin-left: auto;
    }

}

</style>
