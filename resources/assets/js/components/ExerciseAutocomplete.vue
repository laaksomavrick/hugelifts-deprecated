<template>
    <div class="autocomplete">
        <div class="autocomplete__complete" ref="completion"></div>
        <input 
            class="autocomplete__form-control"
            placeholder="Add a new exercise"
            ref="input"
            v-model="text"
            @keyup="handleKeyup"
        >
        </input>
    </div>
</template>

<script>

import { mapGetters } from 'vuex'

export default {

    props: {
        onEnter: Function
    },

    data: function() {
        return {
            text: '',
            match: null
        }
    },

    methods: {

        handleKeyup: function(e) {

            const exercises = this.getExercises
            const text = this.text.toLowerCase()

            const match = exercises.find(exercise => {
                const name = exercise.name.toLowerCase()
                const subIndex = text.length
                if (subIndex > name.length) { return false }
                const substring = name.substring(0, subIndex)
                return text === substring
            })

            //TODO handle lowercase, uppercase

            if (e.key === 'Enter' && match && text.length > 0) {
                this.onEnter(match)
                this.text = null
                this.match = null
                this.$refs.completion.innerText = null
                this.$refs.input.blur()
            } else if (match && text.length > 0) {
                this.match = match
                this.$refs.completion.innerText = match.name
            } else {
                this.match = null
                this.$refs.completion.innerText = null
            }

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

@import '../../sass/bscore';
@import '../../sass/form';

.autocomplete {

    position: relative;
    margin-top: 10px;

    &__form-control {
        background: transparent;

        &:focus {
            background:transparent!important;
        }
    }

    &__complete {
        color: $gray-400;
        transform: translateY(-2px) translateX(1px) ;
        border: none;
    }

    &__form-control, &__complete {
        @extend .form__form-control;
        position: absolute;
        top: 0;
        right: 0;
        padding: 0.375rem 0.75rem;
        margin: 0 auto;
        cursor: text;
    }
}

.autocomplete, .autocomplete__form-control, .autocomplete__complete {
    width: 100%;
    height: 32px;
    line-height: 1.5;
}

</style>
