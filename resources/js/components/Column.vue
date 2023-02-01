<template>
    <div>
        This is a column
    </div>
</template>

<script>
export default {
    data() {
        return {
            message: 'Hello world!',
        };
    },
    mounted() {
        console.log("bla bla column");
    }
};
</script>

<style lang="scss">
$primary: green;

.message {
    font-size: 18px;
    font-family: 'Roboto', sans-serif;
    color: blue;
    background: $primary;
}
</style>
