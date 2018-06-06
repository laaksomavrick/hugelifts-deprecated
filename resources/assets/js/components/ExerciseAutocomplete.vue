<template>
    <div class="container">
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
        <button 
            class="container__add" 
            v-bind:class="{ 'disabled':disabled }"
            @click="handleAdd"
        >
            <font-awesome-icon :icon="plus" />
        </button>
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

@import '../../sass/bscore';
@import '../../sass/form';
@import '~bootstrap/scss/buttons';

.autocomplete {

    position: relative;

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
    margin-right: 5px;
}

.container {
    display: flex;
    align-items: center;
    margin-top: 10px;
    padding-left: 0;
    padding-right: 0;
    &__add {
        @extend .btn;
        @extend .btn-primary;
        padding: 0;
        margin: 0;
        width: 28px;
        height: 25px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
}

</style>
