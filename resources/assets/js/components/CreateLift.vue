<template>
        <lift-form 
            :exercise="null"
            :onSubmit="createExercise"
        />
</template>

<script>

import LiftForm from './LiftForm'
import { mapActions } from 'vuex'

export default {

    components: {
        LiftForm
    },

    methods: {

        ...mapActions([
            'createExercise'
        ])

    }

}

</script>
