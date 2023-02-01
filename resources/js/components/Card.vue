<template>
    <div class="card">
        <div class="card__title" @click="showDetailsModal()">
            {{ card.title }}
        </div>
    </div>
</template>

<script>

import axios from "axios";

export default {
    data() {
        return {
            message: 'Hello world!',
            showModal: false,
            apiUrl: process.env.MIX_API_URL
        };
    },
    props: [
        'card'
    ],
    methods: {
        updateCard: function (title, description) {
            axios.put(`${this.apiUrl}/cards/${this.card.id}`, {
                title: title,
                description: description
            })
                .then(response => {
                    this.card.title = title;
                    this.card.description = description;
                    this.$modal.hideAll();
                })
                .catch(e => {
                    //todo show popup alert
                })
        },

        showDetailsModal: function () {
            this.$modal.show(
                {
                    template: `
                        <div class="card-details">
                        <input class="card-details__title" type="text" v-model="cardTitle">
                        <textarea class="card-details__description" name="description" id="" cols="10" rows="10"
                                  v-model="cardDescription">
                        </textarea>
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
                    props: ['title', 'description', 'id', 'buttons'],
                    data: function () {
                        return {
                            cardTitle: this.title,
                            cardDescription: this.description
                        }
                    },
                    methods: {
                        click(buttonIndex, event, source = 'click') {
                            const button = this.buttons[buttonIndex]
                            const handler = button?.handler

                            if (typeof handler === 'function') {
                                handler(this.cardTitle, this.cardDescription)
                            }
                        }
                    }
                },
                {
                    title: this.card.title,
                    description: this.card.description,
                    id: this.card.id,
                    buttons: [
                        {
                            title: 'Cancel',
                            handler: () => {
                                this.$modal.hideAll();
                            }
                        },
                        {
                            title: 'Update',
                            handler: (title, description) => {
                                this.updateCard(title, description);
                            }
                        }
                    ]
                },
            )

        }
    }

};
</script>

<style lang="scss">
.card {
    box-shadow: var(--ds-shadow-raised, 0 1px 0 #091e4240); //todo change this
    margin: 6px 2px;
    background-color: white;
    padding: 8px;
    border-radius: 3px;
    font-size: 15px;
    cursor: pointer;
}
.card-details {
    //height: auto;
    display: flex;
    flex-direction: column;
    padding: 2rem;

    &__title {
        //width: 100%;
        margin: 1rem;
        padding: 1rem;
    }

    &__description {
        //width: 100%;
        resize: none;
        margin: 1rem;
        padding: 1rem;
    }

    &__btns {
        display: flex;
        justify-content: center;

        button {
            margin: 0 5px;
        }
    }
}
</style>
