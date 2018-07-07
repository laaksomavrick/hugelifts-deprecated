<template>
    <div class="routines">
        <div class="routines__subheader">
            Active
        </div>
        <div
            class="routines__item"
            @click="handleRoutineClick(getActiveRoutine)"
        >
            {{ getActiveRoutine ? getActiveRoutine.name : '' }}
        </div>
        <div class="routines__subheader">
            Inactive
        </div>
        <div
            v-for="routine in getInactiveRoutines"
            class="routines__item"
            @click="handleRoutineClick(routine)"
        >
            {{ routine.name }}
        </div>
    </div>
</template>

<script>

import { mapActions, mapGetters } from 'vuex'
import { EDIT_ROUTINE_ROUTE } from '../constants'

export default {

    methods: {

        handleRoutineClick: function(routine) {
            const id = routine.id
            this.$router.push({ name: EDIT_ROUTINE_ROUTE, params: { id }})
        }

    },

    computed: {

        getActiveRoutine: function() {
            return this.getRoutines.find(r => !!r.active === true)
        },

        getInactiveRoutines: function() {
            return this.getRoutines.filter(r => !!r.active !== true)
        },

        ...mapGetters([
            'getRoutines'
        ])

    }

}

</script>

<style lang="scss" scoped>


</style>
