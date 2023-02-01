<template>
    <div class="bemoban">
        <div class="bemoban__header">
            <button @click="dumpDatabase()">Dump Database</button>
            <button>Dump</button>
            <button>Dump</button>
        </div>
        <div class="board">
            <div v-for="column in columns">
                <column class="board__column"
                        :column="column"
                        v-on:deleteColumn="deleteColumn(column)"
                ></column>
            </div>
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
        },
        dumpDatabase: function () {
            axios.post(`${this.apiUrl}/db/dump`)
                .then(response => {
                    this.columns = response.data
                })
                .catch(e => {
                    this.errors.push(e)
                    //todo show that couldn't fetch columns
                })
        }
    }
};
</script>

<style lang="scss">
$background-color: #D29034;
.bemoban {
    background-color: $background-color;
    padding: 2rem;
    &__header{
        background-color: white;
        padding: 1rem;
        margin: 2rem;
        border-radius: 3px;
        button {
            margin: 1rem 2rem;
            padding: .7rem 1rem;
            background-color: white;
            border-radius: 3px;
            border: 1px solid #D29034;
            cursor: pointer;
        }
    }
}

.board {
    display: flex;
    justify-content: flex-start;

    overflow: auto;
    height: 100vh;
}
</style>
