<template>
    <div class="routines">

        <view-actions class="exercises__actions">
            <template slot="right">
                <b-button 
                    @click="create" 
                    variant="primary">
                    New
                </b-button>
            </template>
        </view-actions>

        <h3 class="routines__subheader">
            Active
        </h3>

        <b-list-group id="routines__active">
            <b-list-group-item
                class="routines__item"
                @click="handleRoutineClick(getActiveRoutine)">
                {{ getActiveRoutine ? getActiveRoutine.name : '' }}
            </b-list-group-item>
        </b-list-group>

        <h3 class="routines__subheader" v-if="inactiveRoutinesExist">
            Inactive
        </h3>

        <b-list-group v-if="inactiveRoutinesExist">
            <b-list-group-item
                v-for="routine in getInactiveRoutines"
                v-bind:key="routine.id"
                class="routines__item"
                @click="handleRoutineClick(routine)">
                {{ routine.name }}
            </b-list-group-item>
        </b-list-group>

    </div>
</template>

<script>

import { mapActions, mapGetters } from 'vuex'
import { EDIT_ROUTINE_ROUTE, NEW_ROUTINE_ROUTE } from '../constants'
import ViewActions from '../components/ViewActions'

export default {

    components: {
        ViewActions
    },

    mounted: function() {
        console.log(this.getRoutines)
    },

    methods: {

        handleRoutineClick: function(routine) {
            const id = routine.id
            this.$router.push({ name: EDIT_ROUTINE_ROUTE, params: { id }})
        },

        create: function() {
            this.$router.push({ name: NEW_ROUTINE_ROUTE })
        }

    },

    computed: {

        getActiveRoutine: function() {
            return this.getRoutines.find(r => !!r.active === true)
        },

        getInactiveRoutines: function() {
            return this.getRoutines.filter(r => !!r.active !== true)
        },

        inactiveRoutinesExist: function() {
            return this.getRoutines.filter(r => !!r.active !== true).length > 0
        },

        ...mapGetters([
            'getRoutines'
        ])

    }

}

</script>

<style lang="scss" scoped>

#routines__active {
    margin-bottom: .5rem;
}

</style>
