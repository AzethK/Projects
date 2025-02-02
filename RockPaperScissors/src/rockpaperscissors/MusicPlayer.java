/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package rockpaperscissors;

import java.io.File;
import javax.sound.sampled.AudioInputStream;
import javax.sound.sampled.AudioSystem;
import javax.sound.sampled.Clip;
import javax.sound.sampled.FloatControl;

/**
 *
 * @author Azeth
 */
public class MusicPlayer {
                        Clip clip;
                        Clip clipMusic;
            public void playMusic(String musicLocation){
            try{
                File musicPath=new File(musicLocation);
                if(musicPath.exists()){
                     clipMusic = AudioSystem.getClip();
                    AudioInputStream audioInput=AudioSystem.getAudioInputStream(musicPath);
                    clipMusic.open(audioInput);
                    FloatControl gainControl = (FloatControl) clipMusic.getControl(FloatControl.Type.MASTER_GAIN);
                    float range = gainControl.getMaximum() - gainControl.getMinimum();
                    float gain = (range * 0.7f) + gainControl.getMinimum();
                    gainControl.setValue(gain);
                    clipMusic.start();
                    clipMusic.loop(Clip.LOOP_CONTINUOUSLY);
                }
                else{
                    System.out.println("Can't find file");
                }
            }
            catch(Exception ex){
                ex.printStackTrace();
            }
        }
            
            public void playOnce(String musicLocation){
                        try{
                File musicPath=new File(musicLocation);
                if(musicPath.exists()){
                     clip = AudioSystem.getClip();
                    AudioInputStream audioInput=AudioSystem.getAudioInputStream(musicPath);
                    clip.open(audioInput);
                    FloatControl gainControl = (FloatControl) clip.getControl(FloatControl.Type.MASTER_GAIN);
                    float range = gainControl.getMaximum() - gainControl.getMinimum();
                    float gain = (range * 0.8f) + gainControl.getMinimum();
                    gainControl.setValue(gain);
                    clip.start();
                }
                else{
                    System.out.println("Can't find file");
                }
            }
            catch(Exception ex){
                ex.printStackTrace();
            }
            }
            public void stopMusic(){
                clipMusic.stop();
            }
}
