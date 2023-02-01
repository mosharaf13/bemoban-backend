<template>
    <div class="board">
        <div v-for="column in columns" :key="column.id">
            <column class="board__column"
                :column="column"
            ></column>
        </div>
    </div>
</template>

<script>
import Column from './Column'
import axios from "axios";

export default {
    components: {
        Column
    },
    props: ['initialCounter'],
    data: function () {
        return {
            columns: [],
            errors: [],
            apiUrl: process.env.MIX_API_URL
        }
    },
    mounted() {
        console.log("bla bla");
        this.fetchColumns();
    },
    methods: {
        fetchColumns: function(){
            axios.get(`${this.apiUrl}/columns`)
                .then(response => {
                    this.columns = response.data
                })
                .catch(e => {
                    this.errors.push(e)
                })
        }
    }
};
</script>

<style lang="scss">
$background-color: #D29034;

.board {
    display: flex;
    justify-content: flex-start;
    background-color: $background-color;
}
</style>
