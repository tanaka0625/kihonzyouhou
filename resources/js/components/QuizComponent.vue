<template>
    <div>
        <button class="btn btn-dark" v-on:click="show_quiz()">クイズ</button>
        <div v-if="is_visible_quiz">

            <div>
                <div id="word">
                    <h2>
                        {{ word }}
                    </h2>
                </div>

                <div id="text" v-show="is_visible_text">
                    {{ text }}
                </div>
                <div>
                    <button class="btn btn-primary" v-on:click="ask()">
                        出題
                    </button>
                    <button class="btn btn-primary" v-on:click="see_text()">
                        解説
                    </button>
                </div>
            </div>


            <div>
                <h3>大機能</h3>
                <div v-for="(category, index) in categories" :key="category.id">
                    <label>
                        {{ category.category }}<input type="checkbox" name="category_checkbox" v-model="category_ckbox_statuses[index].status" v-on:click="click_category_btn(category.id)">
                    </label>
                </div>
            </div>
        

            <div>
                <h3>中機能</h3>
                <div v-for="(sub_category, index) in sub_categories" :key="sub_category.id">
                    <label>
                        {{ sub_category.sub_category }}<input type="checkbox" name="sub_category_checkbox" v-model="sub_category_ckbox_statuses[index].status" v-on:click="click_sub_category_btn(sub_category.id)">
                    </label>
                </div>
            </div>

        </div>
    </div>


</template>





<script>

    export default {
        props: {
            categories: {
                type: Array,
                requires: true
            },
            sub_categories: {
                type: Array,
                requires: true
            },
            item: {
                type: Array
            },
            words: {
                type: Array,
                requires: true
            }

        },
        data() {
            return {
                sub_category_ckbox_statuses: this.get_sub_category_ckbox_statuses(),
                category_ckbox_statuses: this.get_category_ckbox_statuses(),
                // word: this.ask()
                word: "単語",
                text: "解説",
                is_visible_text: true,
                is_visible_quiz: false
            };
        },
        methods: {
            click_sub_category_btn: function (id) {
                for(let i=0; i<this.sub_categories.length; i++)
                {
                    if(this.sub_categories[i].id === id && this.sub_category_ckbox_statuses[i].status === false)
                    {
                        this.sub_category_ckbox_statuses[i].status = true;
                        console.log(this.sub_category_ckbox_statuses);
                        for(let x=0; x<this.categories.length; x++)
                        {
                            console.log(this.categories[x].id);
                            console.log(this.sub_categories[i].category_id);
                            console.log(this.category_ckbox_statuses[x].status);
                            if(this.categories[x].id === this.sub_categories[i].category_id && this.category_ckbox_statuses[x].status === false)
                            {
                                this.category_ckbox_statuses[x].status = true;
                                // console.log(this.categories[x].status);
                                console.log(1);
                            }else if(this.categories[x].id === this.sub_categories[i].category_id && this.category_ckbox_statuses[x].status === true)
                            {
                                console.log(2);

                                break;
                            }else{
                                // console.log(3);
                            }
                        }
                        break;

                    }else if(this.sub_categories[i].id === id && this.sub_category_ckbox_statuses[i].status === true)
                    {
                        this.sub_category_ckbox_statuses[i].status = false;
                        console.log(this.sub_category_ckbox_statuses);
                        break;

                    };
                };
            },
            click_category_btn: function (id) {
                for(let i=0; i<this.categories.length; i++)
                {
                    if(this.categories[i].id === id && this.category_ckbox_statuses[i].status === false)
                    {
                        this.category_ckbox_statuses[i].status = true;
                        console.log(this.category_ckbox_statuses);
                        for(let x=0; x<this.sub_categories.length; x++)
                        {
                            if(this.category_ckbox_statuses[i].id === this.sub_category_ckbox_statuses[x].category_id)
                            {
                                this.sub_category_ckbox_statuses[x].status = true;
                            }
                        }
                        break;

                    }else if(this.categories[i].id === id && this.category_ckbox_statuses[i].status === true)
                    {
                        this.category_ckbox_statuses[i].status = false;
                        console.log(this.category_ckbox_statuses);
                        for(let x=0; x<this.sub_categories.length; x++)
                        {

                            if(this.category_ckbox_statuses[i].id === this.sub_category_ckbox_statuses[x].category_id)
                            {

                                // console.log(this.category_ckbox_statuses[i].id);
                                // console.log(this.sub_category_ckbox_statuses[x].category_id);

                                this.sub_category_ckbox_statuses[x].status = false;
                            }
                        }
                        break;

                    };
                };
            },
            get_sub_category_ckbox_statuses: function () {
                let array = {};
                for(let i=0; i<this.sub_categories.length; i++)
                {
                    array[i] = {
                        id: this.sub_categories[i].id,
                        category_id: this.sub_categories[i].category_id,
                        status: true
                    };
                }
                    
                return array;
            },
            get_category_ckbox_statuses: function () {
                let array = {};
                for(let i=0; i<this.categories.length; i++)
                {
                    array[i] = {
                        id: this.categories[i].id,
                        status: true
                    };
                }
                    
                return array;
            },
            ask: function () {
                console.log(1);
                let cnt=0;
                let array = {};
 
                for(let i=0; i<Object.keys(this.sub_category_ckbox_statuses).length; i++)
                {
                    console.log(2);
                    if(this.sub_category_ckbox_statuses[i].status === true)
                    {
                        for(let x=0; x<this.words.length; x++)
                        {
                            if(this.sub_category_ckbox_statuses[i].id === this.words[x].sub_category_id)
                            {
                                
                                array[cnt] = this.words[x];
                                cnt++;
                            }
                        }
                        
                    }
                }

                let randnum = Math.floor( Math.random() * cnt);
                console.log(array[randnum]);
                this.word = array[randnum].word;
                this.text = array[randnum].text;
                this.is_visible_text = false;
            },
            see_text: function () {
                this.is_visible_text = true;
            },
            show_quiz: function () {
                if(this.is_visible_quiz){
                    this.is_visible_quiz = false;
                }else{
                    this.is_visible_quiz = true;
                }
            }
        }
    }

</script>