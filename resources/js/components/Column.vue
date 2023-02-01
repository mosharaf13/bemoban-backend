<template>
    <div class="column">
        <div class="column__title">
            {{column.title}}
        </div>
        <div class="column__cards" v-for="card in column.cards" :key="card.id">
            <card :card="card"></card>
        </div>
    </div>
</template>

<script>
import Card from './Card';

export default {
    components: {
        Card
    },
    data() {
        return {
            message: 'Hello world!',
        };
    },
    props: [
        'column'
    ],
    mounted() {
        console.log(this.column);
    }
};
</script>

<style lang="scss">
.column {
    width: 17rem;
    background-color: #ebecf0;
    border-radius: 3px;
    max-height: 100%;
    padding: 1rem .5rem;
    margin: 1rem .5rem;

    &__title{
        font-weight: bold;
        font-size: .9rem;
        padding: 8px 4px;
    }
}
</style>
