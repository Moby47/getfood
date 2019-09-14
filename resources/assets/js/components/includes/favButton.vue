<template>
        <a href="#" v-if="isFavorited" data-popup=".popup-social" class="open-popup shopfav" @click.prevent='unFavorite(id)'>
                <img src="images/icons/black/back.png" alt="" title="" /></a>

                <a href="#" v-else data-popup=".popup-social" class="open-popup shopfav" @click.prevent='Favorite(id)'>
                        <img src="images/icons/black/love.png" alt="" title="" /></a>

</template>

<script>
    export default {

        props: ['id'],
//
data: function() {
    return {
        isFavorited: '',
    }
},

        methods: {
            Favorite(id) {
                console.log('fav '+ id)
                this.isFavorited = true
            },

            unFavorite(id) {
                console.log('unfav '+ id)
                this.isFavorited = false
            }
        }
    }
</script>