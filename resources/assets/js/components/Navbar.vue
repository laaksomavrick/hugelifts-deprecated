<template>
    <nav class="navbar">
        asd
    </nav>
</template>

<script>

export default {

    name: 'NavBar',

}

</script>

<style lang="scss" scoped>

@import '../../sass/bscore';
@import '~bootstrap/scss/navbar';
@import '~bootstrap/scss/utilities/background';

.navbar {
    @extend .navbar;
    @extend .navbar-dark;
    @extend .bg-primary;

    color: white;
}

</style>
