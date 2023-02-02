<template>
    <div class="bemoban">
        <div class="bemoban__header">
            <button @click="addColumn()">Add Column</button>
            <button @click="addCard()">Add Card</button>
            <button @click="dumpDb()">Dump DB</button>
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

        dumpDb: function () {
            axios.post(`${this.apiUrl}/db/dump`)
                .then(response => {

                })
                .catch(e => {
                    //todo show popup alert
                })
        },

        addCard: function () {
            this.$modal.show(
                {
                    template: `
                        <div class="card-details">
                        <input class="card-details__title" type="text" v-model="title">
                        <input class="card-details__title" type="text" v-model="description">
                        <select class="card-details__select" v-model="columnName">
                          <option disabled value="">Please select a column name</option>
                          <option v-for="column in columns" v-bind:value="column.id">{{column.title}}</option>
                        </select>

                        <div class="card-details__btns" v-if="buttons">
                            <button
                                v-for="(button, index) in buttons"
                                :class="button.class || 'vue-dialog-button'"
                                type="button"
                                :key="index"
                                v-html="button.title"
                                @click.stop="click(index, $event)"
                            >{{ button.title }}
                            </button>
                        </div>
                        </div>
                    `,
                    props: ['buttons', 'columns'],
                    data: function () {
                        return {
                            title: "Please add card title",
                            description: "Please add card description",
                            columnName: ''
                        }
                    },
                    methods: {
                        click(buttonIndex) {
                            const button = this.buttons[buttonIndex]
                            const handler = button?.handler

                            if (typeof handler === 'function') {
                                handler(this.title, this.description, this.columnName)
                            }
                        }
                    }
                },
                {
                    columns: this.columns,
                    buttons: [
                        {
                            title: 'Cancel',
                            handler: () => {
                                this.$modal.hideAll();
                            }
                        },
                        {
                            title: 'Create',
                            handler: (title, description, columnName) => {
                                this.submitCard(title, description, columnName);
                            }
                        }
                    ]
                },
            )
        },

        addColumn: function () {
            this.$modal.show(
                {
                    template: `
                        <div class="card-details">
                        <input class="card-details__title" type="text" v-model="title">

                        <div class="card-details__btns" v-if="buttons">
                            <button
                                v-for="(button, index) in buttons"
                                :class="button.class || 'vue-dialog-button'"
                                type="button"
                                :key="index"
                                v-html="button.title"
                                @click.stop="click(index, $event)"
                            >{{ button.title }}
                            </button>
                        </div>
                        </div>
                    `,
                    props: ['buttons'],
                    data: function () {
                        return {
                            title: "Please add column title"
                        }
                    },
                    methods: {
                        click(buttonIndex) {
                            const button = this.buttons[buttonIndex]
                            const handler = button?.handler

                            if (typeof handler === 'function') {
                                handler(this.title)
                            }
                        }
                    }
                },
                {
                    buttons: [
                        {
                            title: 'Cancel',
                            handler: () => {
                                this.$modal.hideAll();
                            }
                        },
                        {
                            title: 'Create',
                            handler: (title) => {
                                this.submitColumnTitle(title);
                            }
                        }
                    ]
                },
            )
        },

        submitColumnTitle: function (title) {
            axios.post(`${this.apiUrl}/columns`, {
                title: title
            })
                .then(response => {
                    this.fetchColumns();
                    this.$modal.hideAll();
                })
                .catch(e => {
                    this.errors.push(e)
                    //todo show that couldn't fetch columns
                })
        },

        submitCard: function (title, description, columnName) {
            axios.post(`${this.apiUrl}/cards`, {
                title: title,
                description: description,
                column_id: columnName
            })
                .then(response => {
                    this.fetchColumns();
                    this.$modal.hideAll();
                })
                .catch(e => {
                    this.errors.push(e)
                    //todo show that couldn't fetch columns
                })
        }
    }
};
</script>
S
<style lang="scss">
@import "../../scss/modal.scss";
$background-color: #D29034;
.bemoban {
    background-color: $background-color;
    padding: 2rem;

    &__header {
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
