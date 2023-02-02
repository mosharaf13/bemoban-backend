<template>


    <!--        <div-->
    <!--            class="list-group-item"-->
    <!--            v-for="(element, index) in column.cards"-->
    <!--            :key="element.name"-->
    <!--        >-->
    <!--        </div>-->


</template>

<script>

export default {
    components: {

    },
    props: [
        'column'
    ],
    methods: {


        add: function(event) {
            console.log("inside add");
            console.log(event);
        },

    }
};
</script>

<style lang="scss">



</style>
