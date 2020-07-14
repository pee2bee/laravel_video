//自定义全局常量
// 将变量放到 window 对象上面
// 创建 global.js
//
// window.a = 10;
// 在入口文件中引入
//
// import './global.js'
// 在项目中使用:
//
//思路参考来源:https://segmentfault.com/a/1190000010168571
//
//这里自定义一个绑定常量到window对象的方法,后面调用即可

let bindToGlobal = (obj, key='var') => {
    if (typeof window[key] === 'undefined') {
        window[key] = {};
    }

    for (let i in obj) {
        window[key][i] = obj[i]
    }
}
//绑定api请求域名,调用时,_CONST.API_URL
bindToGlobal({API_URL:"http://laravelvideo.51coode.com/api/"},'_CONST');


