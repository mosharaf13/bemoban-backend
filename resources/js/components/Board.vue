<template>
    <div class="board">
        <column></column>
    </div>
</template>

<script>
import Column from './Column'

export default {
    components: {
        Column
    },
    data() {
        return {
            message: 'Hello world!',
        };
    },
    mounted() {
        console.log("bla bla");
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
