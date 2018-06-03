<template>
        <lift-form 
            :exercise="exercise"
            :onSubmit="updateExercise"
        />
</template>

<script>

import LiftForm from './LiftForm'
import { mapActions, mapGetters } from 'vuex'

export default {

    components: {
        LiftForm
    },

    methods: {

        ...mapActions([
            'updateExercise'
        ])

    },

    computed: {

        exercise: function() {
            //TODO: api call if not found (direct route load)
            return this.getExercise(this.$route.params.id)
        },

        ...mapGetters([
            'getExercise'
        ])

    }

}

</script>
