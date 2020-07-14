<template>
  <div class="page ">
    <!--视频-->
    <video :src="current.path" controls="controls" poster="/static/images/510.jpg"></video>

    <!--视频结束-->

    <h1>10 导航条样式的设置</h1>

    <ul id="list">

      <li v-for="(v,index) in sets"  :class="{cur:index==class_cur}"><a @click.prevent="play(v,index,$event)">{{v.title}}</a></li>
      <!--<li class="cur"><a href="">08 a标签 img标签详解</a></li>-->

    </ul>


    <!--返回按钮-->
    <a class="iconfont back" @click="back()">&#xe612;</a>

  </div>
</template>

<script>
export default {
  name: 'Page',
  data () {
    return {
      sets:[],//视频数据列表数组对象
      msg: 'Welcome to Your Vue.js App',
      current:{},//当前播放的视频数据对象
      class_cur:0,//存放当前点击的id值
    }
  },
  mounted(){
    //加载页面时挂载
      //通过路由参数来获取指定视频列表
    let param = this.$route.params.video_id;
    //alert(param);
    this.axios.get(_CONST.API_URL+'sets/'+param).then((response)=>{
        console.log(response.data);

        //获取到视频列表数组对象
        this.sets = response.data;
        //设当前视频为第一个
        this.current = this.sets[0];
    })
  },
  methods: {
    play(set,index,e){
        //获取点击的视频数据,赋值给this.current,更新当前播放的视频
        this.current = set;
        this.class_cur = index;//这个是要改变样式的
      },
    back(){
        this.$router.back();

    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  * {
    padding: 0;
    margin: 0;
    color: #31343B;
  }

  a {
    text-decoration: none;
    color: #31343B;
  }

  li {
    list-style: none;
  }

  body {
    font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
    /*padding-bottom: 15%;*/
  }


  /*底部固定导航*/
  #bottom {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    display: flex;
    background: #FFFFFF;
    margin: 0;
  }

  #bottom li {
    width: 50%;
    box-sizing: border-box;
  }

  #bottom li i.iconfont {
    color: #888;
    font-size: 6vw;
    display: block;
    text-align: center;
  }

  #bottom li span {
    font-size: 2.6vw;
    display: block;
    text-align: center;
    color: #888;
  }

  #bottom li.cur {
    /*background: #333;*/
  }

  #bottom li.cur i.iconfont {
    color: #333;
  }

  #bottom li.cur span {
    color: #333;
  }
  /*底部固定导航结束*/


  video{
    width: 100%;

  }
  h1{
    font-size: 4.5vw;
    line-height: 2em;
    color: #31343B;
    text-indent: 2em;
    margin: 0;
    font-weight: 700;
  }
  #list{
    /*width: 92%;*/
    /*margin: 0 auto;*/
    border-top: #EFEFF4 5px solid;
    padding-top: 2%;
  }
  #list li a{
    font-size: 3.8vw;
    color: #666;
    line-height: 2.8em;
    display: block;
    margin-left: 6%;
    border-left: 1px dotted #999;
    text-indent: 1em;
    position: relative;
  }
  #list li a:before{
    content: '';
    width: 10px;
    height: 10px;
    background: #ccc;
    position: absolute;
    left: -6px;
    top: 50%;
    transform: translateY(-50%);
    border-radius: 50%;


  }
  #list li.cur a{
    color: #333;
    font-weight: 700;

  }

  #list li.played a{
    color: gray;


  }


  a.iconfont.back{
    font-size: 9vw;
    /*color: #888;*/
    color: deepskyblue;
    position: fixed;
    right: 6%;
    bottom: 3%;
  }

</style>
