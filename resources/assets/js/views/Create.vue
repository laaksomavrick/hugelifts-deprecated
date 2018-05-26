<template>
    <div class="create">
        <div class="create__form">
            <div class="create__form-group">
                <label>Username</label>
                <input class="create__form-control"></input>
            </div>
            <div class="create__form-group">
                <label>Email</label>
                <input class="create__form-control"></input>
            </div>
            <div class="create__form-group">
                <label>Password</label>
                <input class="create__form-control" type="password"></input>
            </div>
            <div class="create__form-group">
                <label>Confirm password</label>
                <input class="create__form-control" type="password"></input>
            </div>
            <button 
                class="create__button"
                @click="submit"
            >
                Submit
            </button>
        </div>
    </div>
</template>

<script>

export default {

    data: function() {
        return {
            username: null,
            email: null,
            password: null
        }
    },

    mounted: function() {

    },

    methods: {

        submit: function() {
            console.log("here")
        }

    },

    computed: {

        valid: function() {
            return (
                   this.password 
                && this.password.length > 6
                && this.username
                && this.email
            )
        }

    }

}

</script>

<style lang="scss" scoped>

@import '../../sass/account';

.create {

    @extend .account;

    &__form {
        @extend .account__form;
    }

    &__form-group {
        @extend .account__form-group;
    }

    &__form-control {
        @extend .account__form-control;
    }

    &__button {
        @extend .account__button;
    }
}

</style>
