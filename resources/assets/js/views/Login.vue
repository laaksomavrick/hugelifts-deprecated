<template>
    <div class="login">
        <form class="login__form">
            <div class="login__form-group">
                <label>Username</label>
                <input class="login__form-control"></input>
            </div>
            <div class="login__form-group">
                <label>Password</label>
                <input class="login__form-control" type="password"></input>
            </div>
            <button class="login__button">
                Submit
            </button>
        </form>
    </div>
</template>

<script>

export default {

    mounted: async function() {

    }

}

</script>

<style lang="scss" scoped>

@import '../../sass/account';

.login {

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
