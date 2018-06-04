<template>
    <lift-form 
        :exercise="null"
        :onSubmit="createExercise"
        title="Create Lift"
        buttonText="Create"
    />
</template>

<script>

import LiftForm from '../components/LiftForm'
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
