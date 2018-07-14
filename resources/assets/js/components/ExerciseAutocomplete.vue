<template>
    <div class="autocomplete">
        <b-input 
            id="typeahead"
            placeholder="Add a new exercise"
            v-model="text"
            @keyup="handleKeyup"
        >
        </b-input>
        <b-button 
            v-bind:class="{ 'disabled':disabled }"
            @click="handleAdd">
            <font-awesome-icon :icon="plus" />
        </b-button>
    </div>
</template>

<script>

import { mapGetters } from 'vuex'
import FontAwesomeIcon from '@fortawesome/vue-fontawesome'
import faPlus from '@fortawesome/fontawesome-free-solid/faPlus'

export default {

    components: {
        FontAwesomeIcon
    },

    props: {
        onSubmit: Function
    },

    data: function() {
        return {
            text: '',
            match: null,
            potentialMatch: null
        }
    },

    methods: {

        handleKeyup: function(e) {

            const exercises = this.getExercises
            const text = this.text.toLowerCase()

            this.potentialMatch = exercises.find(exercise => {
                const name = exercise.name.toLowerCase()
                const subIndex = text.length
                if (subIndex > name.length) { return false }
                const substring = name.substring(0, subIndex)
                return text === substring
            })

            const match = this.potentialMatch

            //TODO handle lowercase, uppercase

            if (e.key === 'Enter' && match && text.length > 0) {
                this.handleAdd()
            } else if (match && text.length > 0) {
                this.match = match
                this.$refs.completion.innerText = match.name
            } else {
                this.match = null
                this.potentialMatch = null
                this.$refs.completion.innerText = null
            }

        },

        handleAdd: function() {

            const match = this.potentialMatch
            if (!match || match.length <= 0) { return }
            this.onSubmit(match)
            this.text = null
            this.match = null
            this.$refs.completion.innerText = null
            this.$refs.input.blur()

        }

    },

    computed: {

        plus: function() {
            return faPlus
        },

        disabled: function() {
            return this.potentialMatch === null
        },

        ...mapGetters([
            'getExercises'
        ])

    }

}

</script>

<style lang="scss" scoped>
</style>
