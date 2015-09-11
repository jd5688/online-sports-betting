function CountdownTimer( elemID, timeLimit, limitMessage, msgClass ) {
	this.initialize.apply( this, arguments );
}

CountdownTimer.prototype = 	{

	/**
	 * Constructor
	 */
	initialize: function( elemID, timeLimit, limitMessage, msgClass ) {
		this.elem = document.getElementById( elemID );
		this.timeLimit = timeLimit;
		this.limitMessage = 'Time Up';
		this.msgClass = msgClass;
	},

	/**
	 * Count down
	 */
	countDown : function()	{
		var	timer;
		var	today = new Date()
		var	days = Math.floor( ( this.timeLimit - today ) / ( 24 * 60 * 60 * 1000 ) );
		var	hours = Math.floor( ( ( this.timeLimit - today ) % ( 24 * 60 * 60 * 1000 ) ) / ( 60 * 60 * 1000 ) );
		var	mins = Math.floor( ( ( this.timeLimit - today ) % ( 24 * 60 * 60 * 1000 ) ) / ( 60 * 1000 ) ) % 60;
		var	secs = Math.floor( ( ( this.timeLimit - today ) % ( 24 * 60 * 60 * 1000 ) ) / 1000 ) % 60 % 60;
		var	me = this;

	        if( ( this.timeLimit - today ) > 0 ){
			timer = '' + days + 'day ' + this.addZero( hours ) + ':' + this.addZero( mins ) + ':'+ this.addZero( secs ) + ''
			this.elem.innerHTML = timer;
			tid = setTimeout( function() { me.countDown(); }, 10 );

	        }else{
			this.elem.innerHTML = this.limitMessage;
			if( this.msgClass )	{
				this.elem.setAttribute( 'class', this.msgClass );
			}
			return;
	        }
	},

	/**
	 * Add zero
	 */
	addZero : function( num )	{
		num = '00' + num;
		str = num.substring( num.length - 2, num.length );

		return str ;
	}
}

