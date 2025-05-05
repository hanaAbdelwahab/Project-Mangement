  // Retrieve score and total from localStorage (or use default if not set)
  const correct = parseInt(localStorage.getItem("score") || 0);
  const total = parseInt(localStorage.getItem("total") || 3);
  
  // Calculate percentage score
  const percentage = (correct / total) * 100;
  
  // Display the result
  document.getElementById("result-text").textContent = `Your result is ${correct} out of ${total} (${percentage.toFixed(1)}%)`;
  
  // Show appropriate image based on score percentage
  setTimeout(() => {
      if (percentage >= 50) {
          document.getElementById("avatar").style.display = "block";
          document.getElementById("avatar").classList.add("animate-avatar");
          RENDERER.init(); // Fireworks
      } else {
          document.getElementById("sad-gif").style.display = "block";
          // Show cloud/lightning background instead of fireworks
          document.getElementById("canvas-container").style.display = "block";
          startStormAnimation();
      }
  }, 100);
  
  var RENDERER = {
      FIREWORK_INTERVAL_RANGE : {min : 20, max : 200},
      SKY_COLOR : 'hsla(270, 60%, %luminance%, 0.2)', // Purple sky background
      STAR_COUNT : 100,
      
      init : function(){
          this.setParameters();
          this.reconstructMethod();
          this.createStars();
          this.render();
      },
      setParameters : function(){
          this.$container = $('#jsi-fireworks-container');
          this.width = this.$container.width();
          this.height = this.$container.height();
          this.distance = Math.sqrt(Math.pow(this.width / 2, 2) + Math.pow(this.height / 2, 2));
          this.contextFireworks = $('<canvas />').attr({width : this.width, height : this.height}).appendTo(this.$container).get(0).getContext('2d');
          this.contextTwigs = $('<canvas />').attr({width : this.width, height : this.height}).appendTo(this.$container).get(0).getContext('2d');
          
          this.stars = [];
          this.fireworks = [new FIREWORK(this.width, this.height, this)];
          
          this.maxFireworkInterval = this.getRandomValue(this.FIREWORK_INTERVAL_RANGE) | 0;
          this.fireworkInterval = this.maxFireworkInterval;
      },
      reconstructMethod : function(){
          this.render = this.render.bind(this);
      },
      getRandomValue : function(range){
          return range.min + (range.max - range.min) * Math.random();
      },
      createStars : function(){
          for(var i = 0, length = this.STAR_COUNT; i < length; i++){
              this.stars.push(new STAR(this.width, this.height, this.contextTwigs, this));
          }
      },
      render : function(){
          requestAnimationFrame(this.render);
          
          var maxOpacity = 0,
              contextTwigs = this.contextTwigs,
              contextFireworks = this.contextFireworks;
          
          for(var i = this.fireworks.length - 1; i >= 0; i--){
              maxOpacity = Math.max(maxOpacity, this.fireworks[i].getOpacity());
          }
          contextTwigs.clearRect(0, 0, this.width, this.height);
          // Purple background
          contextFireworks.fillStyle = this.SKY_COLOR.replace('%luminance', 5 + maxOpacity * 15);
          contextFireworks.fillRect(0, 0, this.width, this.height);
          
          for(var i = this.fireworks.length - 1; i >= 0; i--){
              if(!this.fireworks[i].render(contextFireworks)){
                  this.fireworks.splice(i, 1);
              }
          }
          for(var i = this.stars.length - 1; i >= 0; i--){
              this.stars[i].render(contextTwigs);
          }
          
          if(--this.fireworkInterval == 0){
              this.fireworks.push(new FIREWORK(this.width, this.height, this));
              this.maxFireworkInterval = this.getRandomValue(this.FIREWORK_INTERVAL_RANGE) | 0;
              this.fireworkInterval = this.maxFireworkInterval;
          }
      }
  };

  var STAR = function(width, height, context, renderer){
      this.width = width;
      this.height = height;
      this.renderer = renderer;
      this.init(context);
  };
  STAR.prototype = {
      RADIUS_RANGE : {min : 1, max : 4},
      COUNT_RANGE : {min : 100, max : 1000},
      DELTA_THETA : Math.PI / 30,
      DELTA_PHI : Math.PI / 50000,
      
      init : function(context){
          this.x = this.renderer.getRandomValue({min : 0, max : this.width});
          this.y = this.renderer.getRandomValue({min : 0, max : this.height});
          this.radius = this.renderer.getRandomValue(this.RADIUS_RANGE);
          this.maxCount = this.renderer.getRandomValue(this.COUNT_RANGE) | 0;
          this.count = this.maxCount;
          this.theta = 0;
          this.phi = 0;
          
          // White stars
          this.gradient = context.createRadialGradient(0, 0, 0, 0, 0, this.radius);
          this.gradient.addColorStop(0, 'hsla(0, 0%, 100%, 1)');
          this.gradient.addColorStop(0.1, 'hsla(0, 0%, 95%, 1)');
          this.gradient.addColorStop(0.25, 'hsla(0, 0%, 90%, 1)');
          this.gradient.addColorStop(1, 'hsla(0, 0%, 80%, 0)');
      },
      render : function(context){
          context.save();
          context.globalAlpha = Math.abs(Math.cos(this.theta));
          context.translate(this.width / 2, this.height / 2);
          context.rotate(this.phi);
          context.translate(this.x - this.width / 2, this.y - this.height / 2);
          context.beginPath();
          context.fillStyle = this.gradient;
          context.arc(0, 0, this.radius, 0, Math.PI * 2, false);
          context.fill();
          context.restore();
          
          if(--this.count == 0){
              this.theta = Math.PI;
              this.count = this.maxCount;
          }
          if(this.theta > 0){
              this.theta -= this.DELTA_THETA;
          }
          this.phi += this.DELTA_PHI;
          this.phi %= Math.PI / 2;
      }
  };

  var FIREWORK = function(width, height, renderer){
      this.width = width;
      this.height = height;
      this.renderer = renderer;
      this.init();
  };
  FIREWORK.prototype = {
      // Color function replaced with specific purple/lavender/baby pink palette
      getFireworkColor : function() {
          const colors = [
              'hsl(280, 80%, 60%)', // Purple
              'hsl(270, 80%, 70%)', // Lavender
              'hsl(330, 80%, 85%)'  // Baby Pink
          ];
          return colors[Math.floor(Math.random() * colors.length)];
      },
      PARTICLE_COUNT : 300,
      DELTA_OPACITY : 0.01,
      RADIUS : 2,
      VELOCITY : -3,
      WAIT_COUNT_RANGE : {min : 30, max : 60},
      THRESHOLD : 50,
      DELTA_THETA : Math.PI / 10,
      GRAVITY : 0.002,
      
      init : function(){
          this.setParameters();
          this.createParticles();
      },
      setParameters : function(){
          this.x = this.renderer.getRandomValue({min : this.width / 8, max : this.width * 7 / 8});
          this.y = this.renderer.getRandomValue({min : this.height / 4, max : this.height / 2});
          this.x0 = this.x;
          this.y0 = this.height + this.RADIUS;
          this.color = this.getFireworkColor();
          this.status = 0;
          this.theta = 0;
          this.waitCount = this.renderer.getRandomValue(this.WAIT_COUNT_RANGE);
          this.opacity = 1;
          this.velocity = this.VELOCITY;
          this.particles = [];
      },
      createParticles : function(){
          for(var i = 0, length = this.PARTICLE_COUNT; i < length; i++){
              this.particles.push(new PARTICLE(this.x, this.y, this.color, this.renderer));
          }
      },
      getOpacity : function(){
          return this.status == 2 ? this.opacity : 0;
      },
      render : function(context){
          switch(this.status){
          case 0:
              context.save();
              context.fillStyle = this.color;
              context.globalCompositeOperation = 'lighter';
              context.globalAlpha = (this.y0 - this.y) <= this.THRESHOLD ? ((this.y0 - this.y) / this.THRESHOLD) : 1;
              context.translate(this.x0 + Math.sin(this.theta) / 2, this.y0);
              context.scale(0.8, 2.4);
              context.beginPath();
              context.arc(0, 0, this.RADIUS, 0, Math.PI * 2, false);
              context.fill();
              context.restore();
              
              this.y0 += this.velocity;
              
              if(this.y0 <= this.y){
                  this.status = 1;
              }
              this.theta += this.DELTA_THETA;
              this.theta %= Math.PI * 2;
              this.velocity += this.GRAVITY;
              return true;
          case 1:
              if(--this.waitCount <= 0){
                  this.status = 2;
              }
              return true;
          case 2:
              context.save();
              context.globalCompositeOperation = 'lighter';
              context.globalAlpha = this.opacity;
              
              for(var i = 0, length = this.particles.length; i < length; i++){
                  this.particles[i].render(context, this.opacity);
              }
              context.restore();
              this.opacity -= this.DELTA_OPACITY;
              return this.opacity > 0;
          }
      }
  };

  var PARTICLE = function(x, y, color, renderer){
      this.x = x;
      this.y = y;
      this.color = color;
      this.renderer = renderer;
      this.init();
  };
  PARTICLE.prototype = {
      RADIUS : 1.5,
      VELOCITY_RANGE : {min : 0, max : 3},
      GRAVITY : 0.02,
      FRICTION : 0.98,
      
      init : function(){
          var radian = Math.PI * 2 * Math.random(),
              velocity = (1 - Math.pow(Math.random(), 6)) * this.VELOCITY_RANGE.max,
              rate = Math.random();
              
          this.vx = velocity * Math.cos(radian) * rate;
          this.vy = velocity * Math.sin(radian) * rate;
      },
      render : function(context, opacity){
          context.fillStyle = this.color;
          context.beginPath();
          context.arc(this.x, this.y, this.RADIUS, 0, Math.PI * 2, false);
          context.fill();
          
          this.x += this.vx;
          this.y += this.vy;
          this.vy += this.GRAVITY;
          this.vx *= this.FRICTION;
          this.vy *= this.FRICTION;
      }
  };

  function startStormAnimation() {
      const canvas = document.getElementById("canvas");
      canvas.width = canvas.clientWidth;
      canvas.height = canvas.clientHeight;
      const ctx = canvas.getContext("2d");

      const LEFT = "LEFT";
      const RIGHT = "RIGHT";

      // Share the same firework colors for lightning
      const getLightningColor = function() {
          const colors = [
              'hsl(280, 80%, 60%)', // Purple
              'hsl(270, 80%, 70%)', // Lavender
              'hsl(330, 80%, 85%)'  // Baby Pink
          ];
          return colors[Math.floor(Math.random() * colors.length)];
      };

      const getDir = () => Math.random() * 300 < 16 ? LEFT : RIGHT;

      class Cloud {
          constructor(x, y) {
              this.x = x;
              this.y = y;
              this.size = Math.floor(Math.random() * 30);
              this.clr = "hsla(270, 60%, 40%, 0.5)"; // Matching sky background color
              this.dir = getDir();
              this.speed = Math.floor(Math.random() * 2) + 1;
          }

          moveLeft() { this.x -= this.speed; }
          moveRight() { this.x += this.speed; }

          update() {
              if (this.x <= 0) this.dir = RIGHT;
              else if (this.x >= canvas.width) this.dir = LEFT;
              this.dir === LEFT ? this.moveLeft() : this.moveRight();
          }

          drawRoot(x, y) {
              let sx = x, sy = y, ex, ey;
              ex = sx + Math.floor(Math.random() * 50) - 15;
              ey = sy + Math.floor(Math.random() * 30);
              let i = 0, limit = Math.floor(Math.random() * 20);
              while (i < limit) {
                  ctx.beginPath();
                  ctx.strokeStyle = getLightningColor();
                  ctx.lineWidth = 1;
                  ctx.moveTo(sx, sy);
                  ctx.lineTo(ex, ey);
                  ctx.stroke();
                  sx = ex;
                  sy = ey;
                  ex = sx + Math.floor(Math.random() * 50) - 15;
                  ey = sy + Math.floor(Math.random() * 30);
                  i++;
              }
          }

          drawLightning() {
              // Using the same sky background for the flash
              ctx.fillStyle = "hsla(270, 60%, 40%, 0.2)";
              ctx.fillRect(0, 0, canvas.width, canvas.height);

              let sx = this.x, sy = this.y;
              let ex = sx + Math.floor(Math.random() * 30) - 15;
              let ey = sy + Math.floor(Math.random() * 30);
              let i = 0, limit = Math.floor(Math.random() * 20) + 10;
              
              // Use a random firework color for main lightning bolt
              const mainBoltColor = getLightningColor();

              while (i < limit) {
                  ctx.beginPath();
                  ctx.strokeStyle = mainBoltColor;
                  ctx.lineWidth = 3;
                  ctx.moveTo(sx, sy);
                  ctx.lineTo(ex, ey);
                  ctx.stroke();

                  sx = ex;
                  sy = ey;
                  ex = sx + Math.floor(Math.random() * 30) - 15;
                  ey = sy + Math.floor(Math.random() * 30);

                  if (Math.random() < 0.05) {
                      this.drawRoot(sx, sy);
                  }
                  i++;
              }
          }

          draw() {
              ctx.beginPath();
              ctx.fillStyle = this.clr;
              ctx.arc(this.x, this.y, this.size, 0, 2 * Math.PI);
              ctx.fill();
              if (Math.random() < 0.001) this.drawLightning();
          }
      }

      const clouds = [];
      for (let i = 0; i < canvas.width; i += Math.floor(Math.random() * 100) + 1) {
          clouds.push(new Cloud(i, 0));
      }

      const animate = () => {
          // Match the sky background color from the fireworks
          ctx.fillStyle = "hsla(270, 60%, 20%, 1)";
          ctx.fillRect(0, 0, canvas.width, canvas.height);
          ctx.shadowColor = "hsla(270, 60%, 40%, 0)";
          ctx.shadowBlur = 10;

          for (const c of clouds) {
              c.draw();
              c.update();
          }

          requestAnimationFrame(animate);
      };

      animate();

      window.addEventListener("resize", () => {
          canvas.width = window.innerWidth;
          canvas.height = window.innerHeight;
      });
  }