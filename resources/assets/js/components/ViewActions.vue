<template>
    <b-row>
        <b-col>
            <div class="view-actions">
                <div class="view-actions__left">
                    <slot name="left">
                    </slot>
                </div>
                <div class="view-actions__right">
                    <slot name="right">
                    </slot>
                </div>
            </div>
        </b-col>
    </b-row>
</template>

<script>

export default {

}

</script>

<style lang="scss">

.view-actions {

    height: 40px;
    margin-bottom: .5rem;

    display: flex;
    align-items: center;

    &__left {
    }

    &__right {
        margin-left: auto;
    }

}

</style>