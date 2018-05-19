<template>
    <p>homepage</p>
</template>

<script>

export default {

    mounted: async function() {

      const test = () => {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                console.log("ping!")
                resolve()
            }, 5000)
        })
      }

      await test()

    }

}

</script>
