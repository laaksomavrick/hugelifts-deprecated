<template>
    <nav class="navbar">
        <div class="navbar__brand">
            Brand
        </div>
        <template v-for="route in routes">
            <div class="navbar__item" v-bind:class="{ 'navbar__item--active': isActive(route.route) }">
                <router-link :to="{ name: route.route}" class="navbar__link">{{ route.text }}</router-link>
            </div>
        </template>
    </nav>
</template>

<script>

export default {

    name: 'NavBar',

    data: function() {
        return {
            routes: [
                {route: 'active', text: 'Schedule'},
                {route: 'routines', text: 'Routines'},
                {route: 'lifts', text: 'Lifts'}
            ]
        }
    },

    methods: {

        isActive: function(name) {
            return this.$route.name === name
        }

    }

}

</script>

<style lang="scss" scoped>

@import '../../sass/bscore';
@import '~bootstrap/scss/navbar';
@import '~bootstrap/scss/nav';
@import '~bootstrap/scss/root';
@import '~bootstrap/scss/utilities/background';

.navbar {
    @extend .navbar;
    @extend .navbar-dark;
    @extend .bg-primary;

    color: white;
    justify-content: left;

    &__brand {
        @extend .navbar-brand;
    }

    &__item {

        @extend .nav-item;
        opacity: 0.7;
        margin-left: 10px;
        margin-right: 10px;

        &--active {
            @extend .active;
            opacity: 1.0;
        }

    }

    &__link {
        color: white;
        text-decoration: none;
    }

}

</style>
