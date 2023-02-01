<template>
    <div class="card">
        <div class="card__title">
            {{card.title}}
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            message: 'Hello world!',
        };
    },
    props: [
        'card'
    ],
    mounted() {
        console.log(this.column);
    }
};
</script>

<style lang="scss">
.card{
    box-shadow: var(--ds-shadow-raised,0 1px 0 #091e4240);
    margin: 6px 2px;
    background-color: white;
    padding: 8px;
    border-radius: 3px;
    font-size: 15px;

}
</style>
