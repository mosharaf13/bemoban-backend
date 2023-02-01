<template>
    <div class="board">
        <div v-for="column in columns">
            <column class="board__column"
                    :column="column"
                    v-on:deleteColumn="deleteColumn(column)"
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
    data: function () {
        return {
            columns: [],
            errors: [],
            apiUrl: process.env.MIX_API_URL
        }
    },
    mounted() {
        this.fetchColumns();
    },
    methods: {
        updateData: function (event) {
            console.log("eventbus called");
            console.log(event);
            this.$modal.hide('card-details');
            // EventBus.$off('cardUpdated');
        },

        fetchColumns: function () {
            axios.get(`${this.apiUrl}/columns`)
                .then(response => {
                    this.columns = response.data
                })
                .catch(e => {
                    this.errors.push(e)
                    //todo show that couldn't fetch columns
                })
        },

        deleteColumn: function (column) {
            axios.delete(`${this.apiUrl}/columns/${column.id}`)
                .then(response => {
                    this.columns = this.columns.filter(col => col.id !== column.id)
                })
                .catch(e => {
                    //todo show popup alert
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
    overflow: auto;
    height: 100vh;
}
</style>
