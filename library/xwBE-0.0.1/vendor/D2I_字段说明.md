## Dota2 - API字段说明文档
#### 注:本文档是针对GitHub作者kronusme的开源项目"dota2-api"中的字段进行说明。纯属milo个人为方便网友开发调用dota2Api时使用，本人在此不保证文档的精确无误。如有疑问请自行查询相关资料。当然，如果您发现本文档中的某些错误，也请联系我，我将尽快改正。
                          
### Dota2Api\Mappers\MatchMapperWeb($content)->load()->getDataArray() 下的字段：
                          
#### 1，barracks_status_dire    ：  夜魇兵营状态
#### 2，barracks_status_radiant ：  天辉兵营状态
####  备注：以上两条应当转化为2进制才能使用。

        举个例子：barracks_status_dire : '63'。翻译成中文就是，夜靥兵营状态 : '63'
        63转换成2进制是：111111，然后垂直对应到以下列表中去，就是6座兵营的存在状态。其中：0，摧毁|1，存在
        |           Type               |      Value      |
        |------------------------------|-----------------|
        | TOP 远程兵营                  | 1               |
        | TOP 近战兵营                  | 1               |
        | MID 远程兵营                  | 1               |
        | MID 近战兵营                  | 1               |
        | BOT 远程兵营                  | 1               |
        | BOT 近战兵营                  | 1               |
        
        同理，tower_status_dire | tower_status_radiant 对应地图上双方各自的11座防御塔：
        |           Type               |      Value      |
        |------------------------------|-----------------|
        | ANCIENT TOP                  | 0 or 1          |
        | ANCIENT BOTTOM               | 0 or 1          |
        | TOP 外塔                      | 0 or 1          |
        | TOP 中塔                      | 0 or 1          |
        | TOP 高地塔                    | 0 or 1          |
        | MIDDLE 外塔                   | 0 or 1          |
        | MIDDLE 中塔                   | 0 or 1          |
        | MIDDLE 高地塔                 | 0 or 1          |
        | BOTTOM 外塔                   | 0 or 1          |
        | BOTTOM 中塔                   | 0 or 1          |
        | BOTTOM 高地塔                 | 0 or 1          |


#### 3，cluster     ：  比赛所在的服务器集群 (key-value对应如下)
        |        Cluster         |   Value  |
        |------------------------|----------|
        |  华中                  |  227     |
        |  联通1                 |  231     |
        |  联通2                 |          | 
        |  上海                  |  224     | 
        |  广东                  |  225     | 
        |  浙江                  |  223     |

#### 4，radian_captain | dire_captain：  天辉or夜魇队长。（如果不是队长模式，一般为null）类似的还有dire_logo、dire_name、dire_team_complete和dire_team_id
#### 5，duration    ： 游戏持续时间，单位是秒(s)
#### 6，first_blood_time ： 第一滴血爆发时间，单位是秒(s)
#### 7，game_mode   ： 游戏模式 (key-value对应如下)
        |           Game-Mode          |      Value      |
        |------------------------------|-----------------|
        |        **Supported**         |                 |
        |  None                        | 0               |
        |  全阵营选择                    | 1               |
        |  队长模式                     | 2               |
        |  随机征召                     | 3               |
        |  单人模式                     | 4               |
        |  全随机模式                   | 5               |        
        |  单人模式                     | 4               |        
        |  单中模式                     | 11              |