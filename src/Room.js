import React from 'react';
import ConverstionList from './ConverstionList';
import ChatBox from './ChatBox';
class Room extends React.Component{
    constructor(props)
    {
        super(props)
    }
    render(){
        return(
            <div className="Room">
            <div className="Nav">
            <button>New Chat</button>
              <button>New Secret Chat</button>
            </div>
            <ConverstionList />
            <ChatBox />
            </div>
        )
    }
}
export default Room;