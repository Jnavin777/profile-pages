Я хочу пригласить тебя в команду {{$team->name}}.<br>
Нажми сюда, чтобы присоединиться: <a href="{{route('teams.accept_invite', $invite->accept_token)}}">{{route('teams.accept_invite', $invite->accept_token)}}</a>
