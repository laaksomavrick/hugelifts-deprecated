<template>
    <routine-form 
        :routine="null"
        :onSubmit="createRoutine"
        title="Create Routine"
        buttonText="Create"
    />
</template>

<script>

import RoutineForm from '../components/RoutineForm'
import { mapActions } from 'vuex'

export default {

    components: {
        RoutineForm
    },

    methods: {

        ...mapActions([
            'createRoutine'
        ])

    }

}

</script>
