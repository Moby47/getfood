<template>
       
<div>
        <a v-if='added' href="cart.html" id="addtocart" @click.prevent='cart(con)' >ADD TO TABLE</a>

        <a  else href="cart.html" id="addtocart" @click.prevent='cart(con)' >CLEAR FOOD</a>
</div>
                        
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